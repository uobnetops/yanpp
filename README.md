# yanpp
## Yet another Nagios ping plugin

This is an [ICMP ping](https://en.wikipedia.org/wiki/Ping_(networking_utility)) plugin
for [Nagios](https://www.nagios.org/) which aims to recreate some of the features of
[Smokeping](http://oss.oetiker.ch/smokeping/) inside Nagios, without needing to
set up Smokeping. It is a feature improvement on Nagios's bundled
[`check_ping`](https://www.monitoring-plugins.org/doc/man/check_ping.html)
plugin in terms of the performance data and graphing.

### Installation

It is recommended to install this plugin from the RPM package, to automatically handle
paths and dependencies.

To install this plugin by hand, first make sure you have a working Perl installation
with the following modules available:
* [Net::Ping](http://search.cpan.org/~smpeters/Net-Ping-2.41/lib/Net/Ping.pm)
* [Getopt::Long](http://search.cpan.org/~rse/lcwa-1.0.0/lib/getoptlong/Long.pm)
* [Time::HiRes](http://search.cpan.org/dist/Time-HiRes/HiRes.pm)
* [List::Util](http://search.cpan.org/~pevans/Scalar-List-Utils-1.45/lib/List/Util.pm)
* [Nagios-Plugins](https://nagios-plugins.org/)

These modules can be installed from packages on Red Hat by doing:

```
yum install perl perl-Getopt-Long perl-Time-HiRes perl-Scalar-List-Utils nagios-plugins-perl
```

Copy the actual plugin itself (`check_yanpp`) to your system's Nagios plugin directory
(`/usr/lib64/nagios/plugins/` on Red Hat systems).

If you are using [PNP4Nagios](https://docs.pnp4nagios.org/start) to generate graphs,
it is also recommended to install the template file so the graphs render properly.
Copy `check_yanpp.php` to your PNP template directory
(`/usr/share/nagios/html/pnp4nagios/templates.dist` on Red Hat systems).

### Usage

The only mandatory parameter is `-H|--host` to provide the hostname.

```
check_yanpp -H <host> [-w <warnrta>,<warnpl>%] [-c <critrta>,<critpl>%] -n 5 -s 10
```

* `-V --version`    Print the version of the program
* `-h --help`       Print this help message
* `-w --warning`    Comma-separated warning thresholds for RTA and packet loss. Default: `100,10%`
* `-c --critical`   Comma-separated critical thresholds for RTA and packet loss. Default: `1000,50%`
* `-H --hostname`   Hostname or IP address to ping with ICMP packets
* `-n --number`     Number of ICMP packets to send. Default: `5`
* `-s --sleep`      Time to wait between pings in milliseconds. Default: `10`

### Configuration in Nagios

After installing the plugin, you need to configure a new
[command](https://assets.nagios.com/downloads/nagioscore/docs/nagioscore/3/en/objectdefinitions.html#command)
in Nagios. The example below is the bare minimum you will need (check the path).

```
define command {
    command_name    check_yanpp
    command_line    /usr/lib64/nagios/plugins/check_yanpp -H $HOSTADDRESS$
}
```

If you want to set any of the optional parameters, just append them to the line.

```
define command {
    command_name    check_yanpp
    command_line    /usr/lib64/nagios/plugins/check_yanpp -H $HOSTADDRESS$ -w 200,20% -c 2000,75% -n 10 -s 100
}
```

Once the command has been defined, you can use it in a
[service](https://assets.nagios.com/downloads/nagioscore/docs/nagioscore/3/en/objectdefinitions.html#service)
definition. You can either create a new service for `check_yanpp` or you can simply substitute `check_ping`
for `check_yanpp` to get the same monitoring but with more info.

```
define service {
    check_command           check_yanpp
    host_name               host.example.com
    service_description     Ping
}
```

Restart Nagios for the changes to take effect.
