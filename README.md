# 🛍️ Luxury Ecommerce

**Luxury Ecommerce** is a modern, efficient e-commerce platform built with Laravel. The system allows users to browse, purchase products, and manage orders seamlessly through a user-friendly interface and robust backend.

---

## 📌 Overview

This project serves as a solid foundation for online stores, with a strong focus on:

- Smooth, intuitive shopping experience
- Clean and secure backend
- Consistent interface and layout
- Scalable structure ready for customization

---

## 🚀 Features

- 🛒 **Dynamic Shopping Cart** (for guests and authenticated users)
- 🧾 **Full Checkout System** with address and payment handling
- 📦 **Multi-item Order Support**
- 🔐 **User Authentication (login, register, profile)**
- 🖼️ **Product Listing with Multiple Images (highlighted primary)**
- 🔍 **Stock Control**
- 🗂️ **Admin Fields: user roles, order status**
- 🔁 **Cart persistence via localStorage + session fallback**
- ✉️ **Friendly success and error messages**
- 📄 **Smart redirect after checkout to confirmation screen**

---

## 🧰 Tech Stack

| Layer             | Technology                           |
|-------------------|----------------------------------------|
| Backend           | [Laravel 11](https://laravel.com)      |
| Frontend          | Blade Templates + Tailwind CSS         |
| Database          | MySQL                                  |
| Authentication    | Laravel Breeze                         |
| Scripts           | Vanilla JavaScript + localStorage      |
| Local Dev         | MAMP / Laravel Artisan                 |

---

## 💾 Database Structure

The database schema is consolidated into a single migration (`create_full_schema.php`) to recreate the full system structure in one step. Tables include:

- `users`, `products`, `orders`, `order_items`
- `payments`, `shipping_addresses`, `shopping_bags`
- cache and jobs support for future integrations

---

## 📂 Ready to Scale

This project is ready to clone, run, and deploy. Perfect as a solid starting point for a real-world e-commerce application or as a polished MVP foundation.

---

Created and maintained by **Jhonas Nascimento**
