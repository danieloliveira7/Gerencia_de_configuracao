pipeline {
    agent any

    environment {
        CONTAINER = "integration_app"
        PROJECT_DIR = "/var/www/html"
        CONTAINER_HOMOLOG = "homolog_app"
    }

    stages {
        stage('Deploy em Integração') {
            steps {
                echo "Deploy em Integração iniciado..."
                sh """
                    docker exec ${CONTAINER} git -C ${PROJECT_DIR} fetch --all
                    docker exec ${CONTAINER} git -C ${PROJECT_DIR} reset --hard origin/integration
                    docker exec ${CONTAINER} composer install -d ${PROJECT_DIR}
                """
                echo "Deploy em Integração concluído!"
            }
        }

        stage('Aprovar Deploy em Homologação') {
            steps {
                input message: 'Deseja realizar o deploy em homologação agora?'
            }
        }

        stage('Deploy em Homologação') {
            steps {
                echo "Deploy em Homologação iniciado..."
                sh """
                    docker exec ${CONTAINER_HOMOLOG} git -C ${PROJECT_DIR} fetch --all
                    docker exec ${CONTAINER_HOMOLOG} git -C ${PROJECT_DIR} reset --hard origin/develop
                    docker exec ${CONTAINER_HOMOLOG} composer install -d ${PROJECT_DIR}
                """
                echo "Deploy em Homologação concluído!"
            }
        }
    }

    post {
        success {
            echo "Pipeline finalizado com sucesso."
        }
        failure {
            echo "Falha durante o pipeline. Verifique os logs no Jenkins."
        }
    }
}
