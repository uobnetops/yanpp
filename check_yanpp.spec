Name:		check_yanpp
Version:	1.0.0
Release:	1%{?dist}
Summary:	Yet Another Nagios Ping Plugin

License:	Apache 2.0
URL:		https://github.com/uobnetops/yanpp
Source0:	%{name}.tar.gz

BuildArch:	noarch
Requires:	nagios-plugins-perl

%description
This is an ICMP ping plugin for Nagios which aims to recreate some of the features of Smokeping inside Nagios, without needing to set up Smokeping. It is a feature improvement on Nagios's bundled check_ping plugin in terms of the performance data and graphing.

%prep
%autosetup -n %{name}

%install
rm -rf $RPM_BUILD_ROOT
mkdir -p $RPM_BUILD_ROOT/%{_libdir}/nagios/plugins/
mkdir -p $RPM_BUILD_ROOT/%{_datarootdir}/nagios/html/pnp4nagios/templates/
install -m755 check_yanpp $RPM_BUILD_ROOT/%{_libdir}/nagios/plugins/
install -m755 check_yanpp.php $RPM_BUILD_ROOT/%{_datarootdir}/nagios/html/pnp4nagios/templates/

%files
%{_libdir}/nagios/plugins/check_yanpp
%{_datarootdir}/nagios/html/pnp4nagios/templates/check_yanpp.php
%doc

%changelog
* Thu Sep 22 2016 Jonathan Gazeley <jonathan.gazeley@bristol.ac.uk> - 1.0.0
- initial package
