@servers(['web' => 'root@39.96.61.151'])

@task('deploy')
    cd /var/www/larabbs
    git pull
@endtask
