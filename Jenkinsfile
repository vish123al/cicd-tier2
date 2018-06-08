def gitCommit() {
    sh "git rev-parse HEAD > GIT_COMMIT"
    def gitCommit = readFile('GIT_COMMIT').trim()
    sh "rm -f GIT_COMMIT"
    return gitCommit
}

node {
   
    stage 'Checking out scm for repository'
    checkout scm
    stage '(TEST) unit/integration testing'
    checkstyle canComputeNew: false, defaultEncoding: '', healthy: '', pattern: '**/checkstyle-result.xml', unHealthy: ''
    dry canComputeNew: false, defaultEncoding: '', healthy: '', pattern: '**/cpd.xml', unHealthy: ''
    findbugs canComputeNew: false, defaultEncoding: '', excludePattern: '', healthy: '', includePattern: '', pattern: '**/findbugs.xml', unHealthy: ''
    pmd canComputeNew: false, defaultEncoding: '', healthy: '', pattern: '**/pmd.xml', unHealthy: ''
    warnings canComputeNew: false, canResolveRelativePaths: false, categoriesPattern: '', consoleParsers: [[parserName: 'PHP Runtime']], defaultEncoding: '', excludePattern: '', healthy: '', includePattern: '', messagesPattern: '', parserConfigurations: [[parserName: 'PHP Runtime', pattern: '.php']], unHealthy: '' 
   // sh 'curl -X POST -H "Content-Type: application/json" http://172.29.133.15:8080/v2/apps -d@msql.json'
    //sh 'make test'
    stage '(BUILD) building image'
    sh "docker build -t vdenge/php10:${gitCommit()} ."
    sh "docker login -u vdenge -p 'v!sh@l123' "
    sh "docker pull aquasec/scanner-cli:3.0"
    sh "docker push vdenge/php10:${gitCommit()}"
    sh "docker pull vdenge/php10:${gitCommit()}"
    aqua hideBase: false, hostedImage: '', localImage: "vdenge/php10:${gitCommit()}", locationType: 'local', notCompliesCmd: '', onDisallowed: 'ignore', register: false, registry: 'Docker Hub', showNegligible: false
    stage '(PUBLISH) Pushing the image '
    sh "docker push vdenge/php10:${gitCommit()}"
     stage '(DEPLOY) Deploying the container'
   marathon(
     url: 'http://172.29.133.15:8080',
      forceUpdate: true,
       filename: 'marathon.json',
        appId: 'blog',
        docker: "vdenge/php10:${gitCommit()}".toString()
    )
   
        stage 'Collect test reports'
        
        sh 'touch reports/*.xml'
       junit '**/reports/*.xml'
       stage 'Clean up'
       
                         
   

}
