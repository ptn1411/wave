import { links } from "@prisma/client";
import prisma from "../../db.js";
import createFile from "../storage/createFile.js";

const pdfHandler = async ({ url, id }: links) => {
  const pdf = await fetch(url as string).then((res) => res.blob());

  const buffer = Buffer.from(await pdf.arrayBuffer());

  if (
    Buffer.byteLength(buffer) >
    1024 * 1024 * Number(process.env.PDF_MAX_BUFFER || 2)
  )
    return console.log("Error archiving as PDF: Buffer size exceeded");

  const linkExists = await prisma.links.findUnique({
    where: { id },
  });

  if (linkExists) {
    await createFile({
      data: buffer,
      filePath: `archives/${linkExists.id}/${id}.pdf`,
    });

    await prisma.links.update({
      where: { id },
      data: {
        pdf: `archives/${linkExists.id}/${id}.pdf`,
      },
    });
  }
};

export default pdfHandler;
