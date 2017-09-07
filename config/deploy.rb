require 'capistrano/ext/multistage'

set :application, "city_eye"
set :scm, :git
set :repository, "git@github.com:ZhouxiangHuang/city_eye.git"
set :scm_passphrase, ""
set :user, "root"
set :stages, ["production"]
set :default_stage, "production"

