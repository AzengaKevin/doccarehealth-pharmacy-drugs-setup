interface LaravelPaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface LaravelPaginator<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    links: LaravelPaginationLink[];
}

export type { LaravelPaginationLink, LaravelPaginator };
