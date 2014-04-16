#!/usr/bin/env bash
mkdir /home/git/.ssh
touch /home/git/.ssh/authorized_keys
chmod 0700 /home/git/.ssh
chmod 0600 /home/git/.ssh/authorized_keys
