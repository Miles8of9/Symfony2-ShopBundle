много всяких изменений. см коммит.

шаблоны был вынужден очистить из соображений приватности

для тестов:

    ./console doctrine:schema:create
    ./console doctrine:fixtures:load

routing.yml:

    n3b_shop:
        resource: "@n3bShopBundle/Resources/config/routing/routing.yml"

