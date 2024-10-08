import { Get } from "./request";
import { Collection, Pagination } from "./type";

export const getCollections = (page = 1) => {
    return Get<Pagination<Collection>>(`/api/collections?page=${page}`);
};
