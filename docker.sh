# App Directory
cd /app

# Migrations
yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations
yii migrate --migrationPath=@yii/rbac/migrations

# ElasticSearch
yii mapping

# Fixtures
yii fixture User

# Test Directory
cd /app/tests/bin

# Migrations
./yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations
./yii migrate --migrationPath=@yii/rbac/migrations

# ElasticSearch
./yii mapping

# Fixtures
./yii fixture User