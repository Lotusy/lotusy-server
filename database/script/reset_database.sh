#!/bin/sh
sh clear_database.sh
sh create_database.sh
php dao_gen.php
