# コンテナ起動
up:
	docker compose up -d
# コンテナ起動(Windows)
up-win:
	docker-compose -f docker-compose-win.yaml up -d
# コンテナ停止
down:
	docker compose down
# コンテナイメージボリューム削除
destroy:
	docker compose down --rmi all --volumes --remove-orphans
# コンテナビルド
build:
	docker compose build --no-cache --force-rm
# コンテナビルド(Windows)	
build-win: 
	docker-compose -f docker-compose-win.yaml build
# コンテナシェルログイン
sh:
	docker compose exec php bash
# composer install
composer-install:
	docker compose run php composer install
# npm install
npm-install:
	docker compose run php npm install
# laravelキャッシュクリア
clear:
	docker compose exec php php artisan cache:clear
	docker compose exec php php artisan config:clear
	docker compose exec php php artisan route:clear
	docker compose exec php php artisan view:clear
# laravelキャッシュクリア
migrate:
	docker compose exec php php artisan migrate
