import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import CartPage from './CartPage';

export default function Cart({ auth }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <CartPage />
        </AuthenticatedLayout>
    );
}
