# Magento 2 Store Locator / Store Pickup GraphQL / PWA

[Mageplaza Store Locator for Magento 2](https://www.mageplaza.com/magento-2-store-locator-extension/) enables stores to show their addresses on the Internet and customers to locate the nearest store locations. 

The stores can get their locations to display online so that customers can easily find the store and conveniently see the location most convenient for them to come. They can get accurate directions to your store without any difficulty. That all your store’s locations show up when customers search on the Internet builds trust for them about your store. Imagine they can’t find your locations anywhere, you will be most likely to lose potential customers. 

Integrated with Google Maps and GPS, the extension enables customers to quickly find the nearest store by typing some letters in the search box. A noticeable icon marker will display when the store location is found. The store admin can also easily change their stores' location and preview the changes instantly right from the backend. 

At the sidebar of the store locator page, the store’s information will be displayed in detail, including photos preview in a slider. Customers can view the information quickly and choose the most suitable location. Moreover, the extension provides you with the four most-used map designs that are more outstanding and eye-catchy than the Default. You can also add more beautiful map designs that fit your store better or upload the icon marker with ease. 

The status of the store can be displayed according to the working hours and holidays you set for your store location from the backend. Your store can be set to “Open” during the working hour and “Close” when the working day ends. 

The local SEO is also supported. It helps local customers find the nearest store. Local SEO feature enables store owners to optimize for SEO by adjusting meta title, meta description, and keywords. 

Besides, the extension also supports store pick-up. Customers can choose the store they want to drop by and hand-pick their orders. This adds another shipping method to the online store that brings convenience to the customers’ shopping process. Customers can set up the available time for pick-up so that it’s better for the store to prepare the products for customers. 

What’s more, Magento 2 Store Locator GraphQL is now a part of Mageplaza Store Locator extension that adds GraphQL features. This supports PWA compatibility. 

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-store-locator-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
**Note:**
Magento 2 Store Locator GraphQL requires installing [Mageplaza Store Locator](https://www.mageplaza.com/magento-2-store-locator-extension/) in your Magento installation. 

## 2. How to use 
To start working with Magento 2 Store Locator, you need to: 
- Use Magento 2.3.x. Return your site to developer mode. 
- Set **DraphQL enpoint** `http:///graphql` in URL section. Click on Set endpoint. For example, `http://develop.mageplaza.com/graphq`
- Mageplaza supports query and mutation to view the information by locations by store, configuration by store, pickup config, etc. See more details [here](https://documenter.getpostman.com/view/10589000/SztEZmt8?version=latest#6c1f4cf8-b741-45c1-9b99-5cc684b1f737).

## 3. Devdocs
- [Magento 2 Store Locator API & examples](https://documenter.getpostman.com/view/10589000/SztD5nDd?version=latest)
- [Magento 2 Store Locator GraphQL & examples](https://documenter.getpostman.com/view/10589000/SztEZmt8?version=latest#6c1f4cf8-b741-45c1-9b99-5cc684b1f737)

Click on Run in Postman to add these collections to your workspace quickly.

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module 
Feel free to **Fork** and contribute to this module. 

If you have any ideas, please create a pull request, then we will consider and merge your proposed changes in the main branch. 

## 5. Get support 
- Feel free to contact us if you have any questions. We highly appreciate your contribution to this post. if you have any problem and queries, our support team is also willing to help. 
- If you find it helpful, don't hesitate to leave a **Star** ![star](https://i.imgur.com/S8e0ctO.png)
