#!/bin/sh
sh deploy_core.sh "$@"
sh deploy_account.sh "$@"
sh deploy_business.sh "$@"
sh deploy_comment.sh "$@"
sh deploy_image.sh "$@"
sh deploy_www.sh "$@"
