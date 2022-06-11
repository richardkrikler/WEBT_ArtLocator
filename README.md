# WEBT_Roll-your-Task

Start VueJS
```
cd artlocator && npm run dev
```

Start Server
```
cd server && php -S localhost:3001
```

Create SQLite-DB with ORM
```
php bin/doctrine orm:schema-tool:create
```

Export SQLite-DB
```
sqlite3 db.sqlite
```
```
.output ./db.sql
.dump
.exit
```