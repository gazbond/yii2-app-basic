# App Directory
cd /app

# Migrations
yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations --interactive=0
yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

# ElasticSearch
yii mapping

# Fixtures
yii fixture User --interactive=0

# Test Directory
cd /app/tests/bin

# Migrations
./yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations --interactive=0
./yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

# ElasticSearch
./yii mapping

# Fixtures
./yii fixture User --interactive=0
