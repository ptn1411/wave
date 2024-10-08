import { Get } from "./request";
import { Pagination, Tag } from "./type";

export const getTags = (page = 1) => {
    return Get<Pagination<Tag>>(`/api/tags?page=${page}`);
};
