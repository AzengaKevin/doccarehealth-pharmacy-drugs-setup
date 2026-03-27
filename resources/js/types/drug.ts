export default interface Drug {
    id: string;
    generic_name: string;
    brand_name: string;
    description: string;
    therapeutic_class: string;
    pharmacological_class: string;
    dosage_form_id: string;
    manufacturer_id: string;
    atc_code: string;
    strength: string;
    route_of_administration: string;
    is_prescription_required: boolean;
    is_controlled_substance: boolean;
    barcode: string;
    sku: string;
    unit_of_measure: string;
    pack_size: string;
    side_effects: string;
    contraindications: string;
    drug_interactions: string;
    status: string;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
}
