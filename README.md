[<img src="https://monitoringartist.github.io/managed-by-monitoringartist.png" alt="Managed by Monitoring Artist: DevOps / Docker / Kubernetes / AWS ECS / Zabbix / Zenoss / Terraform / Monitoring" align="right"/>](http://www.monitoringartist.com 'DevOps / Docker / Kubernetes / AWS ECS / Zabbix / Zenoss / Terraform / Monitoring')

# ServiceNow tickets from Zabbix

Python script for custom Zabbix script media. Script uses ServiceNow API.

Please donate to the author, so he can continue to publish other awesome projects
for free:

[![Paypal donate button](http://jangaraj.com/img/github-donate-button02.png)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LB6J222WRUZ4)

# Installation

Copy the `zabbix-create-service-now-incident.py` script into the `AlertScriptsPath` 
directory which is by default `/usr/lib/zabbix/alertscripts` and make it executable:

    $ cd /usr/lib/zabbix/alertscripts
    $ wget https://raw.github.com/monitoringartist/zabbix-script-servicenow/master/zabbix-create-service-now-incident.py 
    $ chmod 755 zabbix-create-service-now-incident.py

# Configuration

To forward Zabbix events to ServiceNow a new media script needs to be created 
and associated with a user. Follow the steps below as a Zabbix Admin user:

1.) Create a new media type [Admininstration > Media Types > Create Media Type]
```
Name: ServiceNow API
Type: Script
Script name: zabbix-create-service-now-incident.py
```
![1](https://github.com/everaldoscabral/zabbix-script-servicenow/blob/master/img/1.PNG?raw=true)
![2](https://github.com/everaldoscabral/zabbix-script-servicenow/blob/master/img/2.PNG?raw=true)


2.) Modify the Media for the Admin user [Administration > Users]
```
Type: ServiceNow API
Send to: string               <--- this string is not used
When active: 1-7,00:00-24:00
Use if severity: (all)
Status: Enabled
```

3.) Configure Action [Configuration > Actions > Create Action > Action]
Event source: Triggers
```
Name: Create ServiceNow ticket
Default Subject: {TRIGGER.STATUS}

Default Message:
Trigger: {TRIGGER.NAME}
Trigger description: {TRIGGER.DESCRIPTION} 
Trigger severity: {TRIGGER.SEVERITY}
Trigger nseverity: {TRIGGER.NSEVERITY}
Trigger status: {TRIGGER.STATUS}
Trigger URL: {TRIGGER.URL}
Host: {HOST.HOST}
Host description: {HOST.DESCRIPTION}
Event age: {EVENT.AGE}
Current Zabbix time: {DATE} {TIME} 

Item values:

1. {ITEM.NAME1} ({HOST.NAME1}:{ITEM.KEY1}): {ITEM.VALUE1}
2. {ITEM.NAME2} ({HOST.NAME2}:{ITEM.KEY2}): {ITEM.VALUE2}
3. {ITEM.NAME3} ({HOST.NAME3}:{ITEM.KEY3}): {ITEM.VALUE3}

Zabbix event ID: {EVENT.ID}
Zabbix web UI: https://zabbix.domain.com/zabbix
```

For a full list of trigger macros see https://www.zabbix.com/documentation/2.4/manual/appendix/macros/supported_by_location

At the Conditions tab, to only forward PROBLEM events:

```
(A)	Maintenance status not in "maintenance" 
(B)	Trigger value = "PROBLEM" 
```

Finally, add an operation:
```
Send to Users: Admin
Send only to: ServiceNow API
```

# Troubleshooting

Set debug to 1 in the script for debug output:
``` 
debug = 1
```
And test script in commandline manually. It is very likely, that your ServiceNow 
instance has different settings (mandatory fields, lists, ...). You should to see 
in server response, what is a problem.

# Author

[Devops Monitoring Expert](http://www.jangaraj.com 'DevOps / Docker / Kubernetes / AWS ECS / Google GCP / Zabbix / Zenoss / Terraform / Monitoring'),
who loves monitoring systems and cutting/bleeding edge technologies: Docker,
Kubernetes, ECS, AWS, Google GCP, Terraform, Lambda, Zabbix, Grafana, Elasticsearch,
Kibana, Prometheus, Sysdig,...

Summary:
* 2000+ [GitHub](https://github.com/monitoringartist/) stars
* 10 000+ [Grafana dashboard](https://grafana.net/monitoringartist) downloads
* 1 000 000+ [Docker image](https://hub.docker.com/u/monitoringartist/) pulls

Professional devops / monitoring / consulting services:

[![Monitoring Artist](http://monitoringartist.com/img/github-monitoring-artist-logo.jpg)](http://www.monitoringartist.com 'DevOps / Docker / Kubernetes / AWS ECS / Google GCP / Zabbix / Zenoss / Terraform / Monitoring')
