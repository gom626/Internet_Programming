#include "inet.h"
#include <stdio.h>
#include <stdlib.h>

int main (int argc, char *argv[]) {
  int sockfd, newsockfd, aa ;
  struct sockaddr_in  cli_addr, serv_addr;
  char buff[1024];
  pname = argv[0];

  /* TCP socket을 연다. */
  if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0) {
     printf("Server : can’t open stream socket\n"); return(0); }

  /* 서버의 주소를 등록하여 클라이언트가 접속가능하게 한다 */
  bzero((char *) &serv_addr, sizeof(serv_addr));
  serv_addr.sin_family = AF_INET;
  serv_addr.sin_addr.s_addr = htonl(INADDR_ANY);
  serv_addr.sin_port = htons(SERV_TCP_PORT);
  if (bind(sockfd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) < 0) {
     printf("Server : can’t bind local address \n"); return(0); }
  listen(sockfd, 5);
  aa = sizeof(cli_addr) ;
  for(;;){
	newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, &aa);
	if (newsockfd < 0) {
		printf("Server : accept error  \n"); return(0); }
	if(fork()==0){/*child 옜옜*/
		close(sockfd);
		if (read(newsockfd, buff, 1024) <= 0) {
			printf("Server : readn error  \n"); return(0); }
		printf("Server : received string[] : %s\n",buff);
		exit(0);
	}
	else{
		close(newsockfd);
	}
  }
  close(sockfd) ; close(newsockfd);
}

