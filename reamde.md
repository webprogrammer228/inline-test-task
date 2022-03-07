Таблицы создавал через phpmyadmin, запросы -
CREATE TABLE `somebase`.`data` ( `id` INT NOT NULL AUTO_INCREMENT , `userId` INT NOT NULL , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `somebase`.`posts` ( `id` INT NOT NULL AUTO_INCREMENT , `postId` INT NOT NULL , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(50) NOT NULL , `body` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

Две таблицы - посты и комментарии. Таблица datas - комментарии, posts - посты. Извиняюсь что не назвал datas comments))). Но суть думаю понятна.

Изначальный запуск скрипта предполагает подгрузку данных в бд, затем уже поиск по данным. Данные не перезаписываются, если записи уже присутствуют. Насчет поиска не совсем понял, как он должен работать, но как я понял, должны фильтроваться записи по наличию какого либо слова или части слова в записи, а от записи тянуть нужные комментарии по ид.

Надеюсь реализовал правильно.
