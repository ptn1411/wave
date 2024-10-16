import prisma from "../../db.js";
import generatePreview from "../generatePreview.js";
import createFile from "../storage/createFile.js";
const handleArchivePreview = async (link, page) => {
    const ogImageUrl = await page.evaluate(() => {
        const metaTag = document.querySelector('meta[property="og:image"]');
        return metaTag ? metaTag.content : null;
    });
    const ogDescription = await page.evaluate(() => {
        const metaTag = document.querySelector('meta[property="og:description"]') ??
            document.querySelector('meta[name="description"]');
        return metaTag ? metaTag.content : null;
    });
    if (ogImageUrl) {
        console.log("Found og:image URL:", ogImageUrl);
        // Download the image
        const imageResponse = await page.goto(ogImageUrl);
        // Check if imageResponse is not null
        if (imageResponse && !link.preview?.startsWith("archive")) {
            const buffer = await imageResponse.body();
            generatePreview(buffer, link.id, link.id);
        }
        await page.goBack();
    }
    else if (!link.preview?.startsWith("archive")) {
        console.log("No og:image found");
        await page
            .screenshot({ type: "jpeg", quality: 20 })
            .then(async (screenshot) => {
            if (Buffer.byteLength(screenshot) >
                1024 * 1024 * Number(process.env.PREVIEW_MAX_BUFFER || 0.1))
                return console.log("Error generating preview: Buffer size exceeded");
            await createFile({
                data: screenshot,
                filePath: `archives/preview/${link.id}/${link.id}.jpeg`,
            });
            await prisma.links.update({
                where: { id: link.id },
                data: {
                    description: ogDescription,
                    preview: `archives/preview/${link.id}/${link.id}.jpeg`,
                },
            });
        });
    }
};
export default handleArchivePreview;
