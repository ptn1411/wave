import { Get } from "./request";
import { Link, Pagination } from "./type";

export const getLinks = (page = 1) => {
    return Get<Pagination<Link>>(`/api/links?page=${page}`);
};
