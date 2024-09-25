# Draivi Task

This service fetches Alko's daily price list and current currency rates (EUR to GBP) using a scheduled job, storing this information in a database. It also provides a simple front-end for interacting with the data.

### Webpage

The webpage will be available at:
<http://dev-draivi-static-website-bucket.s3-website.eu-central-1.amazonaws.com>

### Overview

This project is divided into two parts:

1. Database and Scripting:
   - A PHP script that fetches Alko's price list and currency conversion rates and updates the database daily at `1:00 UTC`.
2. AJAX-based Frontend:
   - A simple front-end interface to display the product list, allowing users to add and clear order amounts, all via AJAX.

### Deployment

1. Install dependencies

```bash
composer install
```

2. Deploy the service

```bash
composer run-script dev
```

### Requirements

Ensure you have the following dependencies installed:

- Serverless Framework (version 3 or later)
- PHP (version 8.0 or later)
- Composer (version 2.7 or later)
- AWS CLI (version 2.2 or later)
- Python (version 3.8 or later)
