# PLACEHOLDER TRIPAL Genetics

**Developed by the University of Saskatchewan, Pulse Crop Bioinformatics team.**

**NOTE: This package will replace the following Tripal v3 modules: [nd_genotypes](https://github.com/UofS-Pulse-Binfo/nd_genotypes), [genotypes_loader](https://github.com/UofS-Pulse-Binfo/genotypes_loader), [tripal_qtl](https://github.com/UofS-Pulse-Binfo/tripal_qtl), [vcf_filter](https://github.com/UofS-Pulse-Binfo/vcf_filter).**

- Genetic maps, markers, sequence variants and QTL
- Large-scale genotypic datasets with both

    - the power of a relational database for tight integration with germplasm, phenotypic data and cross data type tools
    - the speed/ease of flat file storage and querying via the Variant Call Format (VCF)

- Genotype Matrix tool for quick visual querying of genotypic differences between germplasm in smaller regions (e.g. QTL or GWAS peak)
- Management of metadata for VCF files including a form for researchers to filter and download the results in multiple formats.

## Currently under Active Development

This package is not ready for use in Tripal sites as it is actively being developed.
If you would like to help out with the development process, you can start a
development focused docker container as follows:

1. Clone this repository (or a fork if you are an outside collaborator).
2. Create a new branch or checkout an existing one specific to your task.
3. Build the docker image and create a container to develop in.

**Execute from within your cloned repo directory.**

```
docker build --tag=trpgeno:latest .
docker run --publish=80:80 --name=trpgeno -tid --volume=`pwd`:/var/www/drupal9/web/modules/trpgeno trpgeno:latest
docker exec trpgeno service postgresql restart
```

Login and container setup match the [TripalDocker development setup described in the official Tripal documentation](https://tripaldoc.readthedocs.io/en/latest/install/docker.html#development-site-information).
