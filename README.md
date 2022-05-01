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

Create containers and conf files for test and run the app.
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
 ✔ Can updated user product
 ✔ Fails update with invalid input with data set #0
 ✔ Fails update with invalid input with data set #1

Time: 00:04.973, Memory: 36.50 MB

OK (9 tests, 93 assertions)
```