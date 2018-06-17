if [ -x "./tools/wp-cli.phar" ]; then
  echo "Setting up wordpress"
  cd ./tools
elif ! [ -x "$(command -v wp)" ]; then
  echo "Installing Wp-cli"
  cd ./tools
  wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
  chmod +x wp-cli.phar
fi

# Download wp setup
./wp-cli.phar core download

# Launch the containers
# echo "Starting Docker containers..."
# docker-compose -f docker-compose-dev.yml up -d >/dev/null

# Wait until the docker containers are setup properely
# echo "Attempting to connect to wordpress..."
# until $(curl -L http://localhost:8080 -so - 2>&1 | grep -q "WordPress"); do
#     echo -n '.'
#     sleep 5
# done
# echo ''

./wp-cli.phar config create --skip-check --force