#!/usr/bin/env ruby

require 'uri'

def self.run(cmd)
  system(cmd) or raise "Failed to run #{cmd}"
end

def prompt(string)
  print string
  STDOUT.flush
  gets.strip
end

puts
puts "Welcome #{`whoami`.strip}! Please make sure you have cf setup and logged in."
puts

opsman_url = prompt "What IP or hostname (with scheme and port) would you like this SAML server to accept traffic from? "
bosh_url = prompt "What IP or hostname (with scheme and port which is usually https and 8443) would you like this SAML server to accept BOSH director traffic from? Leave this empty if the director has not been deployed yet. "

opsman_entity_id = opsman_url + '/uaa'
bosh_entity_id = bosh_url

opsman_entity_alias = URI(opsman_url).host
bosh_entity_alias = URI(bosh_url).host

opsman_metadata = <<-PHP
$metadata['#{opsman_entity_id}'] = array(
    'AssertionConsumerService' => '#{opsman_url}/uaa/saml/SSO/alias/#{opsman_entity_alias}',
    'SingleLogoutService' => '#{opsman_url}/uaa/saml/SSO/alias/#{opsman_entity_alias}',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);
PHP

bosh_metadata = <<-PHP
$metadata['#{bosh_entity_id}'] = array(
    'AssertionConsumerService' => '#{bosh_url}/saml/SSO/alias/#{bosh_entity_alias}',
    'SingleLogoutService' => '#{bosh_url}/saml/SSO/alias/#{bosh_entity_alias}',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);
PHP

metadata_file = '<?php' + "\n\n" + opsman_metadata + "\n\n"
metadata_file += bosh_metadata unless bosh_url.empty?

File.write('metadata/saml20-sp-remote.php', metadata_file)

name = prompt "What name should this be pushed to pws as: "
if name.length == 0
  puts "Aborting."
  run 'git checkout metadata/saml20-sp-remote.php'
  exit
end

prompt "Hit return to cf push #{name} to your default space and credentials. "

run "cf push #{name} -n #{name} -m 128M -b https://github.com/cf-identity/php-buildpack.git"
run 'git checkout metadata/saml20-sp-remote.php'

