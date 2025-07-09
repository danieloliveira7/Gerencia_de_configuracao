pipeline {
    agent any

    environment {
        CONTAINER = "integration_app"
        PROJECT_DIR = "/var/www/html"
    }

    stages {

        stage('Atualizar Código') {
            steps {
                echo "Atualizando código no ${CONTAINER}..."
                sh """
                    docker exec ${CONTAINER} git -C ${PROJECT_DIR} fetch --all
                    docker exec ${CONTAINER} git -C ${PROJECT_DIR} reset --hard origin/develop
                """
            }
        }

        stage('Instalar Dependências') {
            steps {
                echo "Rodando composer install no ${CONTAINER}..."
                sh "docker exec ${CONTAINER} composer install -d ${PROJECT_DIR}"
            }
        }

        stage('Rodar Testes') {
            steps {
                echo "Ajustando permissão do PHPUnit..."
                sh "docker exec ${CONTAINER} chmod +x ${PROJECT_DIR}/vendor/bin/phpunit"

                echo "Executando PHPUnit..."
                sh "docker exec ${CONTAINER} ${PROJECT_DIR}/vendor/bin/phpunit"
            }
        }

        stage('Aprovação para Homologação') {
            steps {
                input message: 'Os testes passaram. Aprovar deploy para homologação?'
            }
        }

        stage('Deploy em Homologação') {
            steps {
                echo "Executando deploy em homologação no ${CONTAINER}..."
                sh """
                    docker exec ${CONTAINER} git -C ${PROJECT_DIR} pull origin develop
                    docker exec ${CONTAINER} composer install -d ${PROJECT_DIR}
                """
                echo "Deploy concluído em homologação!"
            }
        }
    }

    post {
        success {
            echo "Pipeline concluído com sucesso."
        }
        failure {
            echo "Falha durante a execução do pipeline. Verifique os logs no Jenkins."
        }
    }
}
