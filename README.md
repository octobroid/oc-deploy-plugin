# Auto Git Deployment Plugin for OctoberCMS

This is a plugin that help you to automate every git push into your serer. You can create custom script to run the deployment process.

### Supported Providers

- GitHub
- Bitbucket
- GitLab

### Usage

Create your custom script named `deploy.sh` on your project directory.

```
#!/bin/sh

# Activate maintenance mode
php artisan down

# Update source code
git pull
git submodule init
git submodule update

# Update PHP dependencies
composer install --no-interaction --no-dev --prefer-dist

# Update plugins
php artisan october:up

# Restart supervisor (if any)
supervisorctl restart all

# Update front-end dependencies
yarn install

# Touch main assets
touch themes/my-theme/assets/scss/app.scss

# Clear cache
php artisan cache:clear

# stop maintenance mode
php artisan up
```

Set the `.env` configuration.

```
GIT_DEPLOY_KEY=randomstringhere
GIT_DEPLOY_PROVIDER=bitbucket
GIT_DEPLOY_BRANCH=master
```

Set the webhook on your git repository provider.

#### Bitbucket
1. On your repository open **Settings** > **Webhooks**.
1. Click **Add Webhook**, set the title for example "Deployment".
1. Set the URL to `https://example.com/deploy?key=randomstringhere`. Don't forget to change the domain and the key.
1. Click **Save**.


#### GitHub
*Coming Soon*

#### GitLab
*Coming Soon*
