# Parameter information graphQL API

Example Query:

```graphql
{
  parameter(type: "page") {
    parameter
    key
    descDe
    frontenendDe
  }
}
```

## Fields

- parameter
- key
- descDe
- frontendDe
- descEn
- frontendEn
- type

## Type filter

- page
- action
- session
- ecommerce
- media
- campaign
- urm
- time
- other

Use https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij to query.

## Data input

File `parameterData.csv` is used, which is a pipe-seperated UTF8 file. It was computed and saved from `tableFormJS.xlsx` file via Pandas. All files are in `dataSource` directory. The data came from https://support.webtrekk.com/hc/de/articles/360000061559-Welche-Parameter-k%C3%B6nnen-an-Webtrekk-versendet-werden-

Sascha Stieglitz
27.10.2019
