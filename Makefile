dest_dir=/home/bfroehler/htdocs/joomla25
deploy_dest="deploy_dest"
dest_host:=$(shell ./getdeploy.sh host)
dest_port:=$(shell ./getdeploy.sh port)
name=bfstop
version=0.9.8

component_name=com_$(name)
admin_files=admin/*
admlang_files=admlang/*
zipfile_name=$(component_name)-$(version).zip
src_files=$(name).xml $(site_files) $(admin_files) $(admlang_files) $(media_files)

deploy:
	scp -r -P $(dest_port) $(site_files) $(dest_host):$(dest_dir)/components/$(component_name)/
	scp -r -P $(dest_port) $(admin_files) $(dest_host):$(dest_dir)/administrator/components/$(component_name)/
	scp -r -P $(dest_port) $(admlang_files) $(dest_host):$(dest_dir)/administrator/language/


build:
	rm -f $(zipfile_name)
	zip -r $(zipfile_name) $(src_files)

