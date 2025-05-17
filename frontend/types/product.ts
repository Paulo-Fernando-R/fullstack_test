export  interface Product  {
    id: number;
    name: string;
    description: string;
    price: number;
    imageUrl?: string;
    categoryId: number;
    createdAt: Date;
    updatedAt: Date;
}
