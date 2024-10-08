export interface PaginationMeta {
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
    next_page_url: string;
    path: string;
    prev_page_url: string;
    to: 15;
}

export interface Pagination<T> extends PaginationMeta {
    data: T[];
}

export interface Link {
    id: number;
    name: string;
    type: string;
    description: string;
    url: string;
    textContent: string;
    preview: string;
    image: string;
    pdf: string;
    importDate: string;
    created_at: string;
    updated_at: string;
    author_id: string;
}
export interface Tag {
    id: number;
    name: string;
    author_id: number;
    created_at: string;
    updated_at: string;
}
export interface Collection {
    id: number;
    name: string;
    description: string;
    parent_id: number;
    isPublic: number;
    author_id: number;
    created_at: string;
    updated_at: string;
}
