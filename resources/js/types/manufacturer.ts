export default interface Manufacturer {
    id: string;
    name: string;
    country?: string;
    contact_info?: string;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
}
