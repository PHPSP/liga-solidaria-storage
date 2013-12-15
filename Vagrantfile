# folder where vagrant files are located (modules, manifests, plugins etc.)
$vagrant_path = "vagrant/"

# Warns to use Bindler
unless Vagrant.has_plugin?("Bindler")
  puts "--- WARNING ---"
  puts "I'm using Bindler, https://github.com/fgrehm/bindler"
  puts "It's for 'Dead easy Vagrant plugins management'"
  puts "If you have not it installed in your system,"
  puts "visit https://github.com/fgrehm/bindler#installation for more information"
end


Vagrant.configure("2") do |config|
  if Vagrant.has_plugin?("vagrant-cachier")
    config.cache.auto_detect = true
  end

  if Vagrant.has_plugin?("HostManager")
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
  end

  config.vm.box = "precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  config.vm.hostname = "liga-solidaria-storage.localhost"

  config.vm.network :private_network, ip: "192.168.56.201"
  config.vm.network :forwarded_port, guest: 80, host: 8080
  config.ssh.forward_agent = true

  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--memory", 1024]
    v.customize ["modifyvm", :id, "--name", "liga-solidaria-storage"]
  end

  nfs_setting = RUBY_PLATFORM =~ /darwin/ || RUBY_PLATFORM =~ /linux/
  config.vm.synced_folder "./", "/var/www/liga-solidaria-storage", id: "vagrant-root" , :nfs => nfs_setting
  config.vm.provision :shell, :inline =>
    "if [[ ! -f /apt-get-run ]]; then sudo apt-get update && sudo touch /apt-get-run; fi"

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = $vagrant_path + "manifests"
    puppet.module_path = $vagrant_path + "modules"
    puppet.options = ['--verbose']
    puppet.facter = {
      "vagrant_path" => $vagrant_path
    }
  end

  config.vm.provision :shell, :inline => 'sudo a2dissite 000-default && sudo service apache2 reload'
end
