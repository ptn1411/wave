import dotenv from "dotenv";
dotenv.config({ path: ".env" });
import prisma from "./db.js";
import archiveHandler from "./lib/archiveHandler.js";
const archiveTakeCount = Number(process.env.ARCHIVE_TAKE_COUNT || "") || 5;
async function processBatch() {
    const linksOldToNew = await prisma.links.findMany({
        where: {
            url: { not: null },
            OR: [
                {
                    image: null,
                },
                {
                    image: "pending",
                },
                ///////////////////////
                {
                    pdf: null,
                },
                {
                    pdf: "pending",
                },
                ///////////////////////
                {
                    readable: null,
                },
                {
                    readable: "pending",
                },
                ///////////////////////
                {
                    monolith: null,
                },
                {
                    monolith: "pending",
                },
            ],
        },
        take: archiveTakeCount, // Lấy số lượng bản ghi
        orderBy: { id: "asc" },
    });
    const linksNewToOld = await prisma.links.findMany({
        where: {
            url: { not: null },
            OR: [
                {
                    image: null,
                },
                {
                    image: "pending",
                },
                ///////////////////////
                {
                    pdf: null,
                },
                {
                    pdf: "pending",
                },
                ///////////////////////
                {
                    readable: null,
                },
                {
                    readable: "pending",
                },
                ///////////////////////
                {
                    monolith: null,
                },
                {
                    monolith: "pending",
                },
            ],
        },
        take: archiveTakeCount,
        orderBy: { id: "desc" },
    });
    //   const linksOldToNewIds = linksNewToOld.map((link) => link.id);
    //   const linksNewToOldIds = linksOldToNew.map((link) => link.id);
    //   const linksOldToNewCollections: any = await prisma.$queryRaw`
    //   SELECT * FROM link_collections
    //   WHERE link_id IN (${Prisma.join(linksOldToNewIds)})
    // `;
    //   const linksNewToOldCollections: any = await prisma.$queryRaw`
    // SELECT * FROM link_collections
    // WHERE link_id IN (${Prisma.join(linksNewToOldIds)})
    // `;
    //   const linksOldToNewcollectionIds = linksOldToNewCollections.map((lc: any) =>
    //     Number(lc.collection_id)
    //   );
    //   const linksNewToOldcollectionIds = linksNewToOldCollections.map((lc: any) =>
    //     Number(lc.collection_id)
    //   );
    //   const linksOldToNewcollections = await prisma.collections.findMany({
    //     where: {
    //       id: { in: linksOldToNewcollectionIds },
    //     },
    //   });
    //   const linksNewToOldcollections = await prisma.collections.findMany({
    //     where: {
    //       id: { in: linksNewToOldcollectionIds },
    //     },
    //   });
    //   const linksOldToNewWithCollections: any = linksOldToNew.map((link) => {
    //     const collectionsForLink = linksOldToNewCollections
    //       .filter((lc: any) => Number(lc.link_id) === Number(link.id))
    //       .map((lc: any) =>
    //         linksOldToNewcollections.find(
    //           (col) => Number(col.id) === Number(lc.collection_id)
    //         )
    //       );
    //     return {
    //       ...link,
    //       linkCollections: collectionsForLink,
    //     };
    //   });
    //   const linksNewToOldWithCollections: any = linksOldToNew.map((link) => {
    //     const collectionsForLink = linksNewToOldCollections
    //       .filter((lc: any) => Number(lc.link_id) === Number(link.id))
    //       .map((lc: any) =>
    //         linksNewToOldcollections.find(
    //           (col) => Number(col.id) === Number(lc.collection_id)
    //         )
    //       );
    //     return {
    //       ...link,
    //       linkCollections: collectionsForLink,
    //     };
    //   });
    const archiveLink = async (link) => {
        try {
            console.log("\x1b[34m%s\x1b[0m", `Processing link ${link.url} for user ${link.id}`);
            await archiveHandler(link);
            console.log("\x1b[34m%s\x1b[0m", `Succeeded processing link ${link.url} for user ${link.id}.`);
        }
        catch (error) {
            console.error("\x1b[34m%s\x1b[0m", `Error processing link ${link.url} for user ${link.id}:`, error);
        }
    };
    // Process each link in the batch concurrently
    const processingPromises = [...linksNewToOld, ...linksOldToNew]
        // Make sure we don't process the same link twice
        .filter((value, index, self) => {
        return self.findIndex((item) => item.id === value.id) === index;
    })
        .map((e) => {
        archiveLink(e);
    });
    await Promise.allSettled(processingPromises);
}
const intervalInSeconds = Number(process.env.ARCHIVE_SCRIPT_INTERVAL) || 10;
function delay(sec) {
    return new Promise((resolve) => setTimeout(resolve, sec * 1000));
}
async function init() {
    console.log("\x1b[34m%s\x1b[0m", "Starting the link processing task");
    while (true) {
        try {
            await processBatch();
            await delay(intervalInSeconds);
        }
        catch (error) {
            console.error("\x1b[34m%s\x1b[0m", "Error processing links:", error);
            await delay(intervalInSeconds);
        }
    }
}
init();
