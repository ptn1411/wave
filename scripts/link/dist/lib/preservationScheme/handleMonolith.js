import { execSync } from "child_process";
import prisma from "../../db.js";
import createFile from "../storage/createFile.js";
const handleMonolith = async (link, content) => {
    if (!link.url)
        return;
    try {
        let html = execSync(`monolith - -I -b ${link.url} ${process.env.MONOLITH_CUSTOM_OPTIONS || "-j -F -s"} -o -`, {
            timeout: 120000,
            maxBuffer: 1024 * 1024 * Number(process.env.MONOLITH_MAX_BUFFER || 5),
            input: content,
        });
        if (!html?.length)
            return console.error("Error archiving as Monolith: Empty buffer");
        if (Buffer.byteLength(html) >
            1024 * 1024 * Number(process.env.MONOLITH_MAX_BUFFER || 6))
            return console.error("Error archiving as Monolith: Buffer size exceeded");
        await createFile({
            data: html,
            filePath: `archives/${link.id}/${link.id}.html`,
        }).then(async () => {
            await prisma.links.update({
                where: { id: link.id },
                data: { monolith: `archives/${link.id}/${link.id}.html` },
            });
        });
    }
    catch (err) {
        console.log("Error running MONOLITH:", err);
    }
};
export default handleMonolith;
