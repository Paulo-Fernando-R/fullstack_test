// validation/productSchema.ts
import * as yup from 'yup'

export const productSchema = yup.object({
  name: yup.string().required('Name is required'),
  price: yup
    .number()
    .typeError('Price must be a number')
    .positive('Price must be greater than zero')
    .required('Price is required'),
  category: yup.string().required('Category is required'),
  image_url: yup
    .string()
    .url('Invalid image URL'),
  description: yup
    .string()
    .min(10, 'Description must be at least 10 characters long')
    .required('Description is required')
})
