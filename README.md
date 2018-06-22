# uuid to name

## 用途

- uuid 轉姓名
- 同 uuid 會轉出相同的姓名
- 無法保證碰低撞率, 轉出姓名只用來顯示用
- ~~保證碰撞率很高~~

## 安裝

`composer require nonegrame/uuid-to-name`

## 用法

僅可轉換為英文姓名
```
$uuid = "2cc4069d-ee87-4e41-95d7-7f42dfaf4e37";
$class = new \Nonegrame\UuidToName\UuidToName();
echo $class->convertToName($uuid); // Gregoria Sporer
```
### ☠️☠️ 再次提醒, 無法保證產出的姓名碰撞機率高低 ☠️☠️