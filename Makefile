test:	
	@ echo "Pulling latest images..."
	@ docker pull vishaldenge/php7:latest
	@ echo "Building images..."
	@ docker build  -t vishaldenge/php7 .
	@ echo "Ensuring image is ready"
	@ docker ps
	@ echo "login checking"
	@ docker login -u vishaldenge -p 'v!sh@l123'
	@ echo "testing image for push"
	@ docker push vishaldenge/php7
	@ echo "Testing complete"
