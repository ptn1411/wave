import { Readability } from "@mozilla/readability";
import { links } from "@prisma/client";
import DOMPurify from "dompurify";
import { JSDOM } from "jsdom";
import prisma from "../../db.js";
import createFile from "../storage/createFile.js";

const handleReadablility = async (content: string, link: links) => {
    const window = new JSDOM("").window;
    const purify = DOMPurify(window);
    const cleanedUpContent = purify.sanitize(content);
    const dom = new JSDOM(cleanedUpContent, { url: link.url || "" });
    const article = new Readability(dom.window.document).parse();
    const articleText = article?.textContent
        .replace(/ +(?= )/g, "") // strip out multiple spaces
        .replace(/(\r\n|\n|\r)/gm, " "); // strip out line breaks

    if (articleText && articleText !== "") {
        const collectionId = await prisma.links.findUnique({
            where: { id: link.id },
        });

        const data = JSON.stringify(article);

        if (
            Buffer.byteLength(data, "utf8") >
            1024 * 1024 * Number(process.env.READABILITY_MAX_BUFFER || 1)
        )
            return console.error(
                "Error archiving as Readability: Buffer size exceeded"
            );

        await createFile({
            data,
            filePath: `archives/${collectionId?.id}/${link.id}_readability.json`,
        });

        await prisma.links.update({
            where: { id: link.id },
            data: {
                readable: `archives/${collectionId?.id}/${link.id}_readability.json`,
                textContent: articleText as any,
            },
        });
    }
};

export default handleReadablility;
