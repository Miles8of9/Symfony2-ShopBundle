магазинчег

    - кластерная сортировка товаров по тегам
    - возможность создания групп тегов (Бренды, Теги, др. свойства)
    - разные типы цен для разных групп клиентов
    - блочное кеширование каталога
    - иерархия характеристик товаров

пока в разработке

для тестов:

    ./console doctrine:schema:create
    ./console doctrine:fixtures:load

routing.yml:

    n3b_shop:
        resource: "@n3bShopBundle/Resources/config/routing/routing.yml"