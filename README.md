# uuid to name

## 用途

- uuid 轉姓名
- 同 uuid 會轉出相同的姓名
- 無法保證碰低撞率, 轉出姓名只用來顯示用
- ~~保證碰撞率很高~~

## 用法

```
$uuid = "2cc4069d-ee87-4e41-95d7-7f42dfaf4e37";
$class = new \Nonegrame\UuidToName\UuidToName();
echo $class->uuidToName($uuid); // should echo a name
```

## 製作中... 或許沒有完工的一天