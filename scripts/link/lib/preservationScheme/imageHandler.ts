import { links } from "@prisma/client";
import prisma from "../../db.js";
import generatePreview from "../generatePreview.js";
import createFile from "../storage/createFile.js";

const imageHandler = async ({ url, id }: links, extension: string) => {
  const image = await fetch(url as string).then((res) => res.blob());

  const buffer = Buffer.from(await image.arrayBuffer());

  if (
    Buffer.byteLength(buffer) >
    1024 * 1024 * Number(process.env.SCREENSHOT_MAX_BUFFER || 2)
  )
    return console.log("Error archiving as Screenshot: Buffer size exceeded");

  const linkExists = await prisma.links.findUnique({
    where: { id },
  });

  if (linkExists) {
    await generatePreview(buffer, linkExists.id, id);

    await createFile({
      data: buffer,
      filePath: `archives/${linkExists.id}/${id}.${extension}`,
    });

    await prisma.links.update({
      where: { id },
      data: {
        image: `archives/${linkExists.id}/${id}.${extension}`,
      },
    });
  }
};

export default imageHandler;
