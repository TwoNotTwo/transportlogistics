#### Командя для создания необходимых таблиц и записей в БД:
yii migrate --migrationPath=@common/modules/transportlogistics/migrations/

#### Удаление ранее созданных таблиц и записей из БД
yii migrate/down  --migrationPath=@common/modules/transportlogistics/migrations/

#### Используемые роли и их разрешения
1. tl-role-guest - гость
 * transportlogistics - доступ к разделу

2. tl-role-manager - менеджер
 * transportlogistics
 * transportlogistics/create-request - создание заявки на доставку заказа
 * transportlogistics/set-the-delivery-date - назначение даты доставки

3. tl-role-storekeeper - кладовщик
 * transportlogistics
 * transportlogistics/set-size-cargo - заполнение поля Объем заказа

4. tl-role-logist - логист
 * transportlogistics
 * transportlogistics/set-responsible-driver - назначение водителя, который везет заказ
 * transportlogistics/set-the-delivery-date


### **FAQ**
#### **Этапы доставки заказа**

_В 1C заказ уже создан_

1. Менеджер заполняет анкету (№ заказа, дата заказа, клиент, адрес доставки, предполагаемая дата доставки, время, примечание для водителя, примечание для внутреннего пользования, Excel файл заказа) и отправляет заявку в систему

**_Кладовщик, получив уведомление о заявке_**
2. Вносит изменения в Excel файл, если нужно
3. Распечатывает Excel файл для дальнейшей сборки заказа
4. Смена статуса заказа на "сборка"

**_Когда заказ собран_**
5. Кладовщик вносит объем в заявку
6. Оставляет примечания, если нужно
7. Подтверждает готовность сборки заказа
8. Смена статуса заказа на "собран"
_Отправляется уведомление Логисту, о том, что заказ собран_

**_Логист получив уведомление о том, что заказ собран_**
9. Утверждает дату доставки
10. Оставляет примечания, если нужно
11. Назначает ответственного водителя

_В день доставки заказам, которые должны быть отвезены, присваивается статус "доставка"_
_По истечению даты доставки заказа задается вопрос о его состоянии_
**_Если заказ не доставлен, то Менеджер или Логист_**
12. Меняет дату доставки
13. Смена статуса заказа на "доставлен/был перенесен на другой день (не доставлен)"


#### Стадии/этапы
1. Заявка создана менеджером
2. Склад собрал заказ, указал объем
3. Логист назначил водителя, дату отправки
4. Заказ загружается - указывает склад
5. Заказ находится в доставке
6. Заказ доставлен
