import React, { useState } from 'react';
import './CartPage.css';

const initialItems = [
    {
        id: 1,
        name: 'iphone',
        category: 'Điện Thoại',
        image: 'https://via.placeholder.com/60x60?text=Iphone',
        quantity: 3,
        price: 10000000,
        checked: false,
    },
    {
        id: 2,
        name: 'Laptop',
        category: 'Laptop',
        image: 'https://via.placeholder.com/60x60?text=Laptop',
        quantity: 2,
        price: 20000000,
        checked: false,
    },
    {
        id: 3,
        name: 'Máy ảnh',
        category: 'Máy Ảnh',
        image: 'https://via.placeholder.com/60x60?text=Camera',
        quantity: 2,
        price: 5000000,
        checked: false,
    },
    {
        id: 4,
        name: 'Tai nghe',
        category: 'Phụ kiện',
        image: 'https://via.placeholder.com/60x60?text=Tai+nghe',
        quantity: 1,
        price: 2000000,
        checked: false,
    },
    {
        id: 5,
        name: 'Tai nghe không dây',
        category: 'Phụ kiện',
        image: 'https://via.placeholder.com/60x60?text=Bluetooth',
        quantity: 2,
        price: 1000000,
        checked: false,
    },
];

const format = (num) => new Intl.NumberFormat('vi-VN').format(num) + ' VNĐ';

export default function CartPage() {
    const [items, setItems] = useState(initialItems);

    const handleCheck = (id) => {
        setItems(items.map(item =>
            item.id === id ? { ...item, checked: !item.checked } : item
        ));
    };

    const handleQuantity = (id, delta) => {
        setItems(items.map(item =>
            item.id === id
                ? { ...item, quantity: Math.max(1, item.quantity + delta) }
                : item
        ));
    };

    const handleDelete = () => {
        setItems(items.filter(item => !item.checked));
    };

    const total = items.reduce((sum, item) => sum + item.quantity * item.price, 0);
    const selectedTotal = items
        .filter((item) => item.checked)
        .reduce((sum, item) => sum + item.quantity * item.price, 0);

    const handleBuy = () => {
        const selectedItems = items.filter(item => item.checked);
        if (selectedItems.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm để mua.');
            return;
        }

        const totalAmount = selectedItems.reduce((sum, item) => sum + item.quantity * item.price, 0);

        const names = selectedItems.map(item => item.name).join(', ');
        alert(`Bạn đã mua ${names} với giá ${format(totalAmount)} thành công!`);

        // Xoá các item đã mua
        setItems(items.filter(item => !item.checked));
    };

    return (
        <div className="cart-container">
            <div className="cart-header">
                <h2>🛒 Giỏ Hàng</h2>
                <div className="header-right">
                    <a href="/">Trang Chủ</a> | <strong>Giỏ Hàng</strong>
                    <img src="/images/manhinhdangnhap/logo.png" alt="Logo" className="brand-logo" />
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Chọn</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    {items.map((item) => (
                        <tr key={item.id}>
                            <td><img src={item.image} alt={item.name} /></td>
                            <td>{item.name}</td>
                            <td>{item.category}</td>
                            <td>
                                <input
                                    type="checkbox"
                                    checked={item.checked}
                                    onChange={() => handleCheck(item.id)}
                                />
                            </td>
                            <td>
                                <button className="btn" onClick={() => handleQuantity(item.id, -1)}>-</button>
                                <span style={{ margin: '0 10px' }}>{item.quantity}</span>
                                <button className="btn" onClick={() => handleQuantity(item.id, 1)}>+</button>
                            </td>
                            <td>{format(item.price)}</td>
                            <td>{format(item.quantity * item.price)}</td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <div className="cart-footer">
                <div>
                    <button className="btn" onClick={handleDelete}>Xóa</button>
                </div>
                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'flex-end' }}>
                    <span className="total">Tổng cộng: {format(total)}</span>
                    <span className="total" style={{ color: '#00bfff' }}>
                        Đã chọn: {format(selectedTotal)}
                    </span>
                </div>
                <button className="btn" onClick={handleBuy}>Mua</button>
            </div>
        </div>
    );
}
