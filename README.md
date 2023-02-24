# ddns-updater-webmanager
Sorry but I dont have time to create a login page or make this look pretty, but feel free to take the code and change it if you wish to do so.

Web Interface to facilitate management of the ddns-updater config file

Suggested Installation method:

1) Deploy a php apache container and bind the volume /var/www/html/ to your ddns-updater data folder (where config.json) is located.
2) Ensure you set the relevant permissions to the ddns-updater data folder to ensure your index.php file can read/write.
3) Copy the index.php file from this repository into the ddns-updater data folder alongside your config.json file.


![dnsman](https://user-images.githubusercontent.com/13137984/220908899-a5509aa7-de65-4bf1-a7f8-596de82bf634.jpg)


# Future Update: API

To use these endpoints, you can send HTTP requests to the appropriate URLs. For example:

    To get all existing records: http://yourdomain.com/your-script.php?action=get_records
    To add a new record: send a POST request to http://yourdomain.com/your-script.php with the following parameters in the request body: action=add_record, provider, domain, host, `
