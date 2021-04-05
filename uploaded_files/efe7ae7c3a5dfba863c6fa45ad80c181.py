n = int(input())
s = 1
s_sum = 0

for i in range(1, n + 1):
    s *= i
    s_sum += s
print(s_sum)

