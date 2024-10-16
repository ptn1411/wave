import fs from "fs";
import path from "path";
import s3Client from "./s3Client.js";
import { DeleteObjectsCommand, ListObjectsCommand, } from "@aws-sdk/client-s3";
async function emptyS3Directory(bucket, dir) {
    if (s3Client) {
        const listParams = {
            Bucket: bucket,
            Prefix: dir,
        };
        const deleteParams = {
            Bucket: bucket,
            Delete: { Objects: [] },
        };
        const listedObjects = await s3Client.send(new ListObjectsCommand(listParams));
        if (listedObjects.Contents?.length === 0)
            return;
        listedObjects.Contents?.forEach(({ Key }) => {
            deleteParams.Delete?.Objects?.push({ Key });
        });
        console.log(listedObjects);
        await s3Client.send(new DeleteObjectsCommand(deleteParams));
        if (listedObjects.IsTruncated)
            await emptyS3Directory(bucket, dir);
    }
}
export default async function removeFolder({ filePath }) {
    if (s3Client) {
        try {
            await emptyS3Directory(process.env.SPACES_BUCKET_NAME, filePath);
        }
        catch (err) {
            console.log("Error", err);
        }
    }
    else {
        const storagePath = process.env.STORAGE_FOLDER || "data";
        const creationPath = path.join(process.cwd(), storagePath + "/" + filePath);
        try {
            fs.rmdirSync(creationPath, { recursive: true });
        }
        catch (error) {
            console.log("Collection's archive directory wasn't deleted most likely because it didn't exist...");
        }
    }
}
