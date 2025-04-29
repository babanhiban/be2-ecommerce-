import React from 'react';
import { Link } from '@inertiajs/react';

export default function OrdersIndex({ orders }) {
  return (
    <div className="flex min-h-screen bg-gray-100">
      {/* Sidebar */}
      <aside className="w-60 bg-white shadow-md p-6">
        <h2 className="text-xl font-bold mb-6">📦 Quản lý đơn hàng</h2>
        <nav className="space-y-4 text-gray-700">
          <Link href="/orders" className="block font-semibold text-blue-600">📋 Danh sách đơn hàng</Link>
          <Link href="/orders/create" className="block hover:text-blue-500">➕ Tạo đơn hàng</Link>
          <Link href="/orders/update" className="block hover:text-blue-500">🛠️ Cập nhật đơn hàng</Link>
        </nav>
      </aside>

      {/* Main Content */}
      <main className="flex-1 p-8">
        <h1 className="text-2xl font-bold mb-6">📋 Danh sách đơn hàng</h1>
        <div className="bg-white rounded-xl overflow-hidden shadow-md">
          <table className="min-w-full text-sm text-left">
            <thead className="bg-gray-100 text-gray-700">
              <tr>
                <th className="px-4 py-3">Mã đơn</th>
                <th className="px-4 py-3">Khách hàng</th>
                <th className="px-4 py-3">Ngày tạo</th>
                <th className="px-4 py-3">Trạng thái</th>
                <th className="px-4 py-3">Tổng tiền</th>
                <th className="px-4 py-3">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              {orders.map((order) => (
                <tr key={order.id} className="border-t">
                  <td className="px-4 py-2">#{order.code}</td>
                  <td className="px-4 py-2">{order.customer_name}</td>
                  <td className="px-4 py-2">{order.created_at}</td>
                  <td className="px-4 py-2">{order.status}</td>
                  <td className="px-4 py-2">{Number(order.total_price).toLocaleString()}đ</td>
                  <td className="px-4 py-2 space-x-2">
                    <Link href={`/orders/${order.id}`} className="bg-blue-500 text-white px-3 py-1 rounded">Xem</Link>
                    <Link href={`/orders/${order.id}/edit`} className="bg-yellow-400 text-white px-3 py-1 rounded">Sửa</Link>
                    <button className="bg-red-500 text-white px-3 py-1 rounded">Xoá</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </main>
    </div>
  );
}
