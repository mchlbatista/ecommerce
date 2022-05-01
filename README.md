# eCommerce CommentSold
*Laravel example app*

## Development Setup
---

### Local Requirements
---
1. Make
2. Composer
3. Docker
4. Docker Compose

### Setup

Copy `.env.example -> .env` file.

```
cp .env.example .env
```

Create containers for test and run the app.
```
make setup
```

### Run

Run the app at `http://localhost`
```
make run
```

![app_preview](https://github.com/mchlbatista/ecommerce_commentsold/blob/master/app_preview.png)

### Tests

```
make test
```

```
PHPUnit 9.5.20

Inventory Model (Tests\Feature\InventoryModel)
 ✔ Get user inventory

Inventory Controller (Tests\Feature\InventoryController)
 ✔ Get user inventory
 ✔ Get user inventory sku
 ✔ Get user inventory product id

Products Controller (Tests\Feature\ProductsController)
 ✔ Can get user products
 ✔ Can get user product

Time: 00:03.859, Memory: 34.50 MB

OK (6 tests, 67 assertions)
```