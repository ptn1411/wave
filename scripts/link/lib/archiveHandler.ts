import { links } from "@prisma/client";
import { LaunchOptions, chromium, devices } from "playwright";
import prisma from "../db.js";
import fetchHeaders from "./fetchHeaders.js";
import { removeFiles } from "./manageLinkFiles.js";
import handleArchivePreview from "./preservationScheme/handleArchivePreview.js";
import handleMonolith from "./preservationScheme/handleMonolith.js";
import handleReadablility from "./preservationScheme/handleReadablility.js";
import handleScreenshotAndPdf from "./preservationScheme/handleScreenshotAndPdf.js";
import imageHandler from "./preservationScheme/imageHandler.js";
import pdfHandler from "./preservationScheme/pdfHandler.js";
import createFolder from "./storage/createFolder.js";

const BROWSER_TIMEOUT = Number(process.env.BROWSER_TIMEOUT) || 5;

export default async function archiveHandler(link: links) {
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(
      () =>
        reject(
          new Error(
            `Browser has been open for more than ${BROWSER_TIMEOUT} minutes.`
          )
        ),
      BROWSER_TIMEOUT * 60000
    );
  });

  // allow user to configure a proxy
  let browserOptions: LaunchOptions = {};
  if (process.env.PROXY) {
    browserOptions.proxy = {
      server: process.env.PROXY,
      bypass: process.env.PROXY_BYPASS,
      username: process.env.PROXY_USERNAME,
      password: process.env.PROXY_PASSWORD,
    };
  }

  const browser = await chromium.launch(browserOptions);
  const context = await browser.newContext({
    ...devices["Desktop Chrome"],
    ignoreHTTPSErrors: process.env.IGNORE_HTTPS_ERRORS === "true",
  });

  const page = await context.newPage();

  createFolder({
    filePath: `archives/preview/${link.id}`,
  });

  createFolder({
    filePath: `archives/${link.id}`,
  });

  try {
    await Promise.race([
      (async () => {
        const header = link.url ? await fetchHeaders(link.url) : undefined;

        const contentType = header?.get("content-type");
        let linkType = "url";
        let imageExtension = "png";

        if (!link.url) linkType = link.type as string;
        else if (contentType?.includes("application/pdf")) linkType = "pdf";
        else if (contentType?.startsWith("image")) {
          linkType = "image";
          if (contentType.includes("image/jpeg")) imageExtension = "jpeg";
          else if (contentType.includes("image/png")) imageExtension = "png";
        }

        await prisma.links.update({
          where: { id: link.id },
          data: {
            type: linkType,
            image: !link.image?.startsWith("archive") ? "pending" : undefined,
            pdf: !link.pdf?.startsWith("archive") ? "pending" : undefined,
            monolith: !link.monolith?.startsWith("archive")
              ? "pending"
              : undefined,
            readable: !link.readable?.startsWith("archive")
              ? "pending"
              : undefined,
            preview: !link.preview?.startsWith("archive")
              ? "pending"
              : undefined,
          },
        });

        if (linkType === "image" && !link.image?.startsWith("archive")) {
          await imageHandler(link, imageExtension); // archive image (jpeg/png)
          return;
        } else if (linkType === "pdf" && !link.pdf?.startsWith("archive")) {
          await pdfHandler(link); // archive pdf
          return;
        } else if (link.url) {
          // archive url

          await page.goto(link.url, { waitUntil: "domcontentloaded" });

          const content = await page.content();

          // Preview
          if (
            !link.preview?.startsWith("archives") &&
            !link.preview?.startsWith("unavailable")
          )
            await handleArchivePreview(link, page);

          // Readability
          if (
            !link.readable?.startsWith("archives") &&
            !link.readable?.startsWith("unavailable")
          )
            await handleReadablility(content, link);

          // Screenshot/PDF
          if (
            (!link.image?.startsWith("archives") &&
              !link.image?.startsWith("unavailable")) ||
            (!link.pdf?.startsWith("archives") &&
              !link.pdf?.startsWith("unavailable"))
          )
            await handleScreenshotAndPdf(link, page);

          // Monolith
          if (
            !link.monolith?.startsWith("archive") &&
            !link.monolith?.startsWith("unavailable") &&
            link.url
          )
            await handleMonolith(link, content);
        }
      })(),
      timeoutPromise,
    ]);
  } catch (err) {
    console.log(err);
    console.log("Failed Link details:", link);
    throw err;
  } finally {
    const finalLink = await prisma.links.findUnique({
      where: { id: link.id },
    });

    if (finalLink)
      await prisma.links.update({
        where: { id: link.id },
        data: {
          readable: !finalLink.readable?.startsWith("archives")
            ? "unavailable"
            : undefined,
          image: !finalLink.image?.startsWith("archives")
            ? "unavailable"
            : undefined,
          monolith: !finalLink.monolith?.startsWith("archives")
            ? "unavailable"
            : undefined,
          pdf: !finalLink.pdf?.startsWith("archives")
            ? "unavailable"
            : undefined,
          preview: !finalLink.preview?.startsWith("archives")
            ? "unavailable"
            : undefined,
        },
      });
    else {
      await removeFiles(link.id, link.id);
    }

    await browser.close();
  }
}
