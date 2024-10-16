import { links } from "@prisma/client";
import { Page } from "playwright";
import prisma from "../../db.js";
import createFile from "../storage/createFile.js";

const handleScreenshotAndPdf = async (link: links, page: Page) => {
  await page.evaluate(autoScroll, Number(process.env.AUTOSCROLL_TIMEOUT) || 30);

  // Check if the user hasn't deleted the link by the time we're done scrolling
  const linkExists = await prisma.links.findUnique({
    where: { id: link.id },
  });
  if (linkExists) {
    const processingPromises = [];

    if (!link.image?.startsWith("archive")) {
      processingPromises.push(
        page
          .screenshot({ fullPage: true, type: "jpeg" })
          .then(async (screenshot) => {
            if (
              Buffer.byteLength(screenshot) >
              1024 * 1024 * Number(process.env.SCREENSHOT_MAX_BUFFER || 2)
            )
              return console.log(
                "Error archiving as Screenshot: Buffer size exceeded"
              );

            await createFile({
              data: screenshot,
              filePath: `archives/${linkExists.id}/${link.id}.jpeg`,
            });
            await prisma.links.update({
              where: { id: link.id },
              data: {
                image: `archives/${linkExists.id}/${link.id}.jpeg`,
              },
            });
          })
      );
    }

    const margins = {
      top: process.env.PDF_MARGIN_TOP || "15px",
      bottom: process.env.PDF_MARGIN_BOTTOM || "15px",
    };

    if (!link.pdf?.startsWith("archive")) {
      processingPromises.push(
        page
          .pdf({
            width: "1366px",
            height: "1931px",
            printBackground: true,
            margin: margins,
          })
          .then(async (pdf) => {
            if (
              Buffer.byteLength(pdf) >
              1024 * 1024 * Number(process.env.PDF_MAX_BUFFER || 2)
            )
              return console.log(
                "Error archiving as PDF: Buffer size exceeded"
              );

            await createFile({
              data: pdf,
              filePath: `archives/${linkExists.id}/${link.id}.pdf`,
            });

            await prisma.links.update({
              where: { id: link.id },
              data: {
                pdf: `archives/${linkExists.id}/${link.id}.pdf`,
              },
            });
          })
      );
    }
    await Promise.allSettled(processingPromises);
  }
};

const autoScroll = async (AUTOSCROLL_TIMEOUT: number) => {
  const timeoutPromise = new Promise<void>((resolve) => {
    setTimeout(() => {
      resolve();
    }, AUTOSCROLL_TIMEOUT * 1000);
  });

  const scrollingPromise = new Promise<void>((resolve) => {
    let totalHeight = 0;
    let distance = 100;
    let scrollDown = setInterval(() => {
      let scrollHeight = document.body.scrollHeight;
      window.scrollBy(0, distance);
      totalHeight += distance;
      if (totalHeight >= scrollHeight) {
        clearInterval(scrollDown);
        window.scroll(0, 0);
        resolve();
      }
    }, 100);
  });

  await Promise.race([scrollingPromise, timeoutPromise]);
};

export default handleScreenshotAndPdf;
