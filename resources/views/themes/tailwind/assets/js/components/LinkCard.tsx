import { EllipsisVertical, Folder, Link } from "lucide-react";
import React from "react";
import { Link as TLink } from "../services/type";
import { Card } from "./ui/card";
interface Props {
    link: TLink;
}
const LinkCard: React.FC<Props> = ({ link }) => {
    return (
        <>
            <Card>
                <div className="rounded-2xl cursor-pointer h-full flex flex-col justify-between">
                    <div>
                        <div className="relative rounded-t-2xl h-40 overflow-hidden">
                            <div className="bg-gray-50 duration-100 h-40 bg-opacity-80" />
                            <div className="absolute top-0 left-0 right-0 bottom-0 rounded-t-2xl flex items-center justify-center shadow rounded-md">
                                <div className="text-4xl text-black aspect-square bg-white shadow rounded-md border-[2px] flex item-center justify-center border-white select-none z-10  w-12 h-12">
                                    <Link className="m-auto" />
                                </div>
                            </div>
                        </div>
                        <hr className="divider my-0 border-t border-neutral-content h-[1px]" />
                    </div>
                    <div className="flex flex-col justify-between h-full">
                        <div className="p-3 flex flex-col gap-2">
                            <p className="truncate w-full pr-9 text-primary text-sm">
                                {link?.name}
                            </p>
                            <a
                                target="_blank"
                                title="chrome-native://newtab/"
                                className="flex gap-1 item-center select-none text-neutral hover:opacity-70 duration-100 max-w-full w-fit"
                                href="chrome-native:/newtab/"
                            >
                                <i className="bi-link-45deg text-lg leading-none" />
                                <p className="text-xs truncate">{link?.url}</p>
                            </a>
                        </div>
                        <div>
                            <hr className="divider mt-2 mb-1 last:hidden border-t border-neutral-content h-[1px]" />
                            <div className="flex justify-between text-xs text-neutral px-3 pb-1 gap-2">
                                <div className="cursor-pointer truncate">
                                    <a
                                        className="flex items-center gap-1 max-w-full w-fit hover:opacity-70 duration-100 select-none"
                                        title="Imports"
                                        href="/collections/17"
                                    >
                                        <Folder
                                            className="text-lg drop-shadow"
                                            style={{
                                                color: "rgb(14, 165, 233)",
                                            }}
                                        />
                                        <p className="capitalize">Imports</p>
                                    </a>
                                </div>
                                <div className="flex items-center gap-1 text-neutral min-w-fit">
                                    <EllipsisVertical className="text-lg" />

                                    <p>{link?.importDate}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Card>
        </>
    );
};
export default LinkCard;
